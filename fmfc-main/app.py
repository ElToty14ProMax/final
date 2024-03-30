from flask import Flask, request, send_file, render_template, jsonify, session, redirect, url_for
import pandas as pd
import psycopg2
from psycopg2 import sql
import json
import os
from flask import redirect, render_template, request, session, url_for
import random
import string
from flask_sqlalchemy import SQLAlchemy

app = Flask(__name__)
app.secret_key = 'UCLV2024'

from flask import Flask, render_template
import psycopg2

app = Flask(__name__)

# Configuración de la conexión a la base de datos
conn = psycopg2.connect(
    host="127.0.0.1",
    database="practica",
    user="postgres",
    password="Toty*020314"
)

@app.route('/mostrar_estudiantes')
def mostrar_estudiantes():
    # Consulta para obtener todos los datos de la tabla "estudiante"
    cursor = conn.cursor()
    cursor.execute("SELECT * FROM estudiante")
    estudiantes = cursor.fetchall()
    column_names = [desc[0] for desc in cursor.description]  # Obtener los nombres de las columnas
    cursor.close()

    # Renderizar la plantilla HTML con los datos obtenidos
    return render_template('Mostrar Datos.html', estudiantes=estudiantes, column_names=column_names)

if __name__ == '__main__':
    app.run(debug=True)


@app.route('/login', methods=['GET', 'POST'])
def login():
    if 'username' in session:
        return redirect(url_for('read_excel'))

    if request.method == 'POST':
        username = request.form['username']
        password = request.form['password']

        # Verificar las credenciales del usuario en la base de datos
        conn = psycopg2.connect(
            host="127.0.0.1",
            database="practica",
            user="postgres",
            password="Toty*020314"
        )

        cursor = conn.cursor()

        # Ejecutar una consulta para verificar las credenciales del usuario
        query = "SELECT COUNT(*) FROM usuario WHERE username = %s AND password = %s"
        cursor.execute(query, (username, password))
        count = cursor.fetchone()[0]

        # Cerrar el cursor y la conexión a la base de datos
        cursor.close()
        conn.close()

        if count == 1:
            session['username'] = username
            return redirect(url_for('read_excel'))
        else:
            return render_template('login.html')

    return render_template('login.html')

@app.route('/importar', methods=['GET', 'POST'])
def read_excel():
    if request.method == 'POST':
        # Obtener el archivo Excel cargado por el usuario
        file = request.files['excel_file']
        
        # Leer el archivo Excel
        df = pd.read_excel(file, sheet_name='Estudiantes', dtype={'Identidad': str})

        # Conexión a la base de datos
        conn = psycopg2.connect(
            host="127.0.0.1",
            database="practica",
            user="postgres",
            password="Toty*020314"
        )

        # Obtener los ID y nombres de la tabla 'pais'
        pais_query = "SELECT id, nombre FROM pais"
        pais_df = pd.read_sql_query(pais_query, conn)

        # Crear tabla Estudiante si no existe previamente
        create_table_query = 'CREATE TABLE IF NOT EXISTS Estudiante (id SERIAL PRIMARY KEY'
        for column in df.columns:
            column_name = column.replace(' ', '_').lower()
            if column_name == 'identidad':
                column_type = str
            else:
                column_type = df[column].dtype

            if column_name != 'país':
                if column_type == 'int64':
                    create_table_query += f', {column_name} INTEGER'
                elif column_type == 'float64':
                    create_table_query += f', {column_name} FLOAT'
                elif column_type == 'bool':
                    create_table_query += f', {column_name} BOOLEAN'
                else:
                    create_table_query += f', {column_name} TEXT'

        create_table_query += ',pais_id INTEGER REFERENCES pais(id));'
        cursor = conn.cursor()
        cursor.execute(create_table_query)
        conn.commit()
        
        # Insertar registros en la tabla Estudiante
        for index, row in df.iterrows():
            insert_query = 'INSERT INTO Estudiante VALUES (DEFAULT'
            for column in df.columns:
                column_name = column.replace(' ', '_').lower()
                column_value = row[column]
                
                if column_name != 'país':
                    if df[column].dtype == 'bool':
                        column_value = str(column_value)

                    insert_query += f", '{column_value}'"

            # Obtener el ID correspondiente del país
            pais_id = pais_df[pais_df['nombre'] == row['País']]['id'].values[0]
            insert_query += f", {pais_id});"

            cursor.execute(insert_query)
            conn.commit()

        # Cerrar la conexión a la base de datos
        cursor.close()
        conn.close()

        return 'Tabla creada y registros insertados correctamente.'
    
    return render_template("Importar Archivo.html")

@app.route('/datos', methods=['GET'])
def obtener_datos():
    conn = psycopg2.connect(
        host="127.0.0.1",
        database="practica",
        user="postgres",
        password="Toty*020314"
    )
    cursor = conn.cursor()
    
    # Obtener los nombres de las columnas de la tabla
    cursor.execute("SELECT * FROM estudiante")
    column_names = [desc[0] for desc in cursor.description]

    # Ejecutar una consulta en la base de datos
    cursor.execute("SELECT * FROM estudiante")

    # Obtener los resultados de la consulta
    resultados = cursor.fetchall()

    # Convertir los resultados a un formato JSON
    datos_json = []
    for resultado in resultados:
        dato = {}
        for i, columna in enumerate(column_names):
            dato[columna] = resultado[i]
        datos_json.append(dato)

    # Guardar el archivo JSON en una ubicación específica
    ruta_directorio = 'JSON/'
    nombre_archivo = 'datos.json'
    ruta_archivo = os.path.join(ruta_directorio, nombre_archivo)
    
    # Verificar si el directorio existe, si no, crearlo
    if not os.path.exists(ruta_directorio):
        os.makedirs(ruta_directorio)

    with open(ruta_archivo, 'w') as archivo:
        json.dump(datos_json, archivo)
    
    # Cerrar el cursor y la conexión a la base de datos
    cursor.close()
    conn.close()

    # Devolver los datos como una respuesta JSON
    return jsonify(datos_json)

@app.route('/mostrar_datos', methods=['GET'])
def mostrar_datos():
    # Conexión a la base de datos
    conn = psycopg2.connect(
        host="127.0.0.1",
        database="practica",
        user="postgres",
        password="Toty*020314"
    )
    cursor = conn.cursor()

    # Obtener los filtros de la consulta
    municipio = request.args.get('municipio')
    becado = request.args.get('becado')

    # Construir la consulta SQL con los filtros
    query = "SELECT * FROM estudiante WHERE 1=1"
    params = []

    if municipio:
        query += " AND municipio <> %s"
        params.append(municipio)

    if becado:
        query += " AND becado = %s"
        params.append(becado)

    # Ejecutar la consulta en la base de datos
    cursor.execute(query, params)

    # Obtener los resultados de la consulta
    resultados = cursor.fetchall()

    # Obtener los nombres de las columnas de la tabla
    column_names = [desc[0] for desc in cursor.description]

    # Cerrar el cursor y la conexión a la base de datos
    cursor.close()
    conn.close()

    # Pasar los datos a la plantilla HTML
    return render_template('Mostrar Datos.html', data=resultados, columns=column_names)



if __name__ == '__main__':
    app.run(debug=True)