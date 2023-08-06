from flask import Flask, render_template, request, redirect, url_for, flash
from flask_mysqldb import MySQL

app = Flask(__name__, static_folder='assets', template_folder='templates')

# Konfigurasi koneksi ke MySQL
app.config['MYSQL_HOST'] = 'localhost'  # Sesuaikan dengan host Anda
app.config['MYSQL_USER'] = 'root'  # Sesuaikan dengan username MySQL Anda
app.config['MYSQL_PASSWORD'] = ''  # Sesuaikan dengan password MySQL Anda
app.config['MYSQL_DB'] = 'dbbengkel'  # Sesuaikan dengan nama database Anda

mysql = MySQL(app)


@app.route('/')
def index():
    cur = mysql.connection.cursor()
    cur.execute("SELECT * FROM tb_pesanan")  # Mengambil semua data dari tabel tb_pesanan
    data = cur.fetchall()
    cur.close()
    return render_template('index.html', data=data)  # Mengirim data ke template index.html


@app.route('/edit/<int:pesanan_id>', methods=['GET'])
def edit(pesanan_id):
    cur = mysql.connection.cursor()
    cur.execute("SELECT * FROM tb_pesanan WHERE id=%s", (pesanan_id,))
    pesanan = cur.fetchone()
    cur.close()
    return render_template('edit.html', pesanan=pesanan)


@app.route('/update', methods=['POST'])
def update():
    if request.method == 'POST':
        id_data = request.form['id_pesanan']
        nama = request.form['nama']
        alamat = request.form['alamat']
        telepon = request.form['telepon']
        status_pesanan = request.form['status_pesanan']

        cur = mysql.connection.cursor()
        cur.execute(
            "UPDATE tb_pesanan SET nama=%s, alamat=%s, telepon=%s ,status_pesanan=%s WHERE id=%s",
            (nama, alamat, telepon,status_pesanan, id_data)
        )
        mysql.connection.commit()
        cur.close()

        return redirect('/')

@app.route('/delete/<int:pesanan_id>', methods=['DELETE'])
def delete(pesanan_id):
    cur = mysql.connection.cursor()
    cur.execute("DELETE FROM tb_pesanan WHERE id=%s", (pesanan_id,))
    mysql.connection.commit()
    cur.close()
    return render_template('index.html')


if __name__ == '__main__':
    app.run(debug=True)
