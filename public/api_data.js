const mysql=require('mysql2');
const db= mysql.createConnection({
    host:'localhost',
    user:'root',
    password:'',
    database:'dailypharma2'
});
db.connect((err)=>{
    if(err){
        console.error('MySQL connection error:', err);

    }else {
    console.log('Connected to MySQL database');
  }
});
const userSchema={
   id_ssn:{type:'INT(11)', allowNull:false},
   User_type:{type:'VARCHAR(100)',allowNull:false},
   Password:{type:'VARCHAR(100)',allowNull:false},
};
module.exports = {db,
    userSchema};