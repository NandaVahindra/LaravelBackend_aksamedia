## Tugas 1

### Membuat Api Login

- Endpoint /login
- Method: POST
- Expected Request Format

json
```
{
    "username": "admin",
    "password": "pastibisa",
}
```

- Expected Response Format

json
```
{
    "status": "success / error",
    "message": "pesan sukses / error",
    "data": {
        "token": "token untuk autentikasi",
        "admin": {
            "id": "uuid admin",
            "name": "nama admin",
            "username": "username admin",
            "phone": "no telepon admin",
            "email": "email admin",
        },
    }
}
```

## Tugas 2

### Membuat Api Get All Data Divisi

- Endpoint /divisions
- Method: GET
- Bisa difilter berdasarkan nama
- Siapkan data dummy menggunakan seeder
- Isi data dummy (Mobile Apps, QA, Full Stack, Backend, Frontend, UI/UX Designer)
- Expected Request Format

json
```
{
    "name": "pencarian nama",
}
```

- Expected Response Format

json
```
{
    "status": "success / error",
    "message": "pesan sukses / error",
    "data": {
        "divisions": [
            {
                "id": "uuid divisi",
                "name": "nama divisi",
            },
            {
                "id": "uuid divisi",
                "name": "nama divisi",
            }
        ],
    },
    "pagination": {
        "berisikan attribute pagination laravel":"..."
    },
}
```

## Tugas 3

### Membuat Api Get All Data Karyawan

- Endpoint /employees
- Method: GET
- Bisa difilter berdasarkan nama
- Bisa difilter berdasarkan divisi
- Expected Request Format

json
```
{
    "name": "pencarian nama",
    "division_id": "filter berdasarkan divisi",
}
```

- Expected Response Format
json
```
{
    "status": "success / error",
    "message": "pesan sukses / error",
    "data": {
        "employees": [
            {
                "id": "uuid pegawai",
                "image": "url foto pegawai",
                "name": "nama pegawai",
                "phone": "no telepon pegawai",
                "division": {
                    "id": "uuid divisi",
                    "name": "nama divisi"
                },
                "position": "jabatan pegawai",
            },
            {
                "id": "uuid pegawai",
                "image": "url foto pegawai",
                "name": "nama pegawai",
                "phone": "no telepon pegawai",
                "division": {
                    "id": "uuid divisi",
                    "name": "nama divisi"
                },
                "position": "jabatan pegawai",
            }
        ],
    },
    "pagination": {
        "berisikan attribute pagination laravel":"..."
    },
}
```

## Tugas 4

### Membuat Api Create Data Karyawan

- Endpoint /employees
- Method: POST
- Expected Request Format

json
```
{
    "image": "file foto pegawai",
    "name": "nama pegawai",
    "phone": "no telepon pegawai",
    "division": "uuid divisi",
    "position": "jabatan pegawai",
}
```

- Expected Response Format

json
```
{
    "status": "success / error",
    "message": "pesan sukses / error",
}
```

## Tugas 5

### Membuat Api Update Data Karyawan

- Endpoint /employees/{id}
- Method: PUT
- Expected Request Format

json
```
{
    "image": "file foto pegawai",
    "name": "nama pegawai",
    "phone": "no telepon pegawai",
    "division": "uuid divisi",
    "position": "jabatan pegawai",
}
```

- Expected Response Format

json
```
{
    "status": "success / error",
    "message": "pesan sukses / error",
}
```

## Tugas 6

### Membuat Api Delete Data Karyawan

- Endpoint /employees/{id}
- Method: DELETE
- Expected Response Format

json
```
{
    "status": "success / error",
    "message": "pesan sukses / error",
}
```

## Tugas 7

### Membuat Api Logout

- Endpoint /logout
- Method: POST
- Expected Response Format

json
```
{
    "status": "success / error",
    "message": "pesan sukses / error",
}
```
