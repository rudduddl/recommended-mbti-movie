from flask import Flask, request, jsonify, render_template
import mysql.connector

app = Flask(__name__)

# MySQL 데이터베이스 연결 설정
db_config = {
    'user': 'your_username',
    'password': 'your_password',
    'host': 'localhost',
    'database': 'board_db'
}

def get_db_connection():
    conn = mysql.connector.connect(**db_config)
    return conn

@app.route('/')
def index():
    conn = get_db_connection()
    cursor = conn.cursor(dictionary=True)
    cursor.execute('SELECT * FROM posts ORDER BY created_at DESC')
    posts = cursor.fetchall()
    cursor.close()
    conn.close()
    return render_template('index.html', posts=posts)

@app.route('/add_post', methods=['POST'])
def add_post():
    username = request.form['username']
    content = request.form['content']

    conn = get_db_connection()
    cursor = conn.cursor()
    cursor.execute('INSERT INTO posts (username, content) VALUES (%s, %s)', (username, content))
    conn.commit()
    cursor.close()
    conn.close()

    return jsonify({'status': 'success'})

if __name__ == '__main__':
    app.run(debug=True)