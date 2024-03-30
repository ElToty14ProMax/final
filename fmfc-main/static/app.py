from flask import Flask, request, render_template, send_file, session, redirect, url_for
import pandas as pd
import psycopg2
from psycopg2 import sql
import json
import os
from flask import Flask, jsonify
import psycopg2
from werkzeug.security import generate_password_hash, check_password_hash

app = Flask(__name__)

@app.route('/work', methods=['GET', 'POST'])
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
    
    return '''
        <form method="POST" enctype="multipart/form-data">
            <input type="file" name="excel_file">
            <input type="submit" value="Importar">
        </form>
    '''

def get_user(username):
    conn = psycopg2.connect(
        host="127.0.0.1",
        database="practica",
        user="postgres",
        password="Toty*020314"
    )
    cursor = conn.cursor()
    cursor.execute("SELECT * FROM usuario WHERE username = %s", (username,))
    user = cursor.fetchone()
    cursor.close()
    conn.close()
    return user

@app.route('/', methods=['GET', 'POST'])
def login():
    if request.method == 'POST':
        username = request.form['username']
        password = request.form['password']
        user = get_user(username)
        print(f"User from database: {user}")  # Agrega esta línea para depurar
        if user and password(user[2], password):  # Verifica la contraseña
            session['user_id'] = user[0]  # Almacena el ID del usuario en la sesión
            return redirect(url_for('datos'))  # Redirige al usuario a la ruta /datos
        else:
            return 'Invalid username or password',   401  # Devuelve un mensaje de error si la autenticación falla
    return send_file('MFC.html')  # Muestra el formulario de inicio de sesión

@app.route('/logout')
def logout():
    session.pop('user_id', None)
    return redirect(url_for('index'))

@app.route('/datos', methods=['GET'])
def datos():
    if 'user_id' not in session:
        return redirect(url_for('login'))
    # Aquí va la lógica para obtener y mostrar los datos
    return 'Datos del usuario'

def get_user(username):
    conn = psycopg2.connect(
        host="127.0.0.1",
        database="practica",
        user="postgres",
        password="Toty*020314"
    )
    cursor = conn.cursor()
    cursor.execute("SELECT * FROM usuario WHERE username = %s", (username,))
    user = cursor.fetchone()
    cursor.close()
    conn.close()
    return user

if __name__ == '__main__':
    app.run()
