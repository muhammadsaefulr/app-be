Table pegawai {
nip varchar [pk]           
nama varchar                
tempat_lahir varchar        
tgl_lahir date              
alamat varchar             
gender char(1)             
agama varchar               
}

Table pegawai_auth{
nip varchar [ref: > pegawai.nip] 
password varchar
}

Table unit_tugas {
id int [pk, increment]      
nip varchar [ref: > pegawai.nip]  
gol varchar               
eselon varchar             
jabatan varchar            
unit_kerja varchar         
}

Table tempat_tugas {
id int [pk, increment]      // Primary key sebagai identifier tempat tugas
nip varchar [ref: > pegawai.nip]  // Foreign key ke pegawai
tempat_tugas varchar        // Lokasi tempat tugas pegawai
}

Table kontak_pegawai {
id int [pk, increment]      // Primary key untuk data kontak
nip varchar [ref: > pegawai.nip]  // Foreign key ke pegawai
no_hp varchar               // Nomor HP pegawai
npwp varchar                // NPWP pegawai, biasanya unik
}