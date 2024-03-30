import psycopg2

def conectar_a_postgresql():
    try:
        # Establecer los detalles de conexión a la base de datos
        dbname = 'practica'
        user = 'postgres'
        password = 'Toty*020314'
        host = 'localhost'
        port = '5432'

        # Establecer la conexión a la base de datos
        conn = psycopg2.connect(dbname=dbname, user=user, password=password, host=host, port=port)

        # Realizar operaciones en la base de datos

        # Cerrar la conexión
        conn.close()

    except psycopg2.Error as e:
        print('Error al conectar a la base de datos:', e)

# Llamar a la función para establecer la conexión
conectar_a_postgresql()