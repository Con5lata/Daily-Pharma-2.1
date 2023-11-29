const express=require('express');
const cors=require('cors');
const app=express();
const bodyParser = require('body-parser');
const authRoutes = require('./api_auth');
app.use(cors());
app.use(bodyParser.json());
const path = require('path'); 
app.use(express.static(path.join(__dirname)));

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

app.get('/apiUsers', (req, res) => {
    const query = 'SELECT * FROM api_access_request';

    db.query(query, (error, results) => {
        if (error) {
            console.error('Error fetching API users:', error);
            res.status(500).json({ error: 'Internal server error' });
        } else {
            res.json(results);
        }
    });
});

app.get('/',(req,res)=>{
    res.sendFile(__dirname+'/register.html');

});
app.use('/api',authRoutes);
const path = require('path');
app.get('/register.html', (req, res) => {
    console.log('Request for register.html received.');
    res.sendFile(path.join(__dirname, 'register.html'));
  });
  app.get('/index.html', (req, res) => {
    console.log('Request for index.html received.');
    res.sendFile(path.join(__dirname, 'index.html'));
  });
  
  app.post('/updateUser', (req, res) => {
    const { id_ssn, User_type, resource_requested } = req.body;

    const updateQuery = `
        UPDATE api_access_request
        SET resource_requested = ?
        WHERE id_ssn = ? AND User_type = ?
    `;

    db.query(updateQuery, [resource_requested, id_ssn, User_type], (error) => {
        if (error) {
            console.error('Error updating user details:', error);
            res.status(500).json({ error: 'Internal server error' });
        } else {
            //res.status(200).json({ message: 'User details updated successfully' });
            const query2=`UPDATE api_access
            SET drugs= 'allowed'
            WHERE id_ssn = ? AND user_type = ?`;
            db.query(query2,[id_ssn, User_type],(error2)=>{
                if (error2) {
                    console.error('Error updating user details:', error2);
                    res.status(500).json({ error2: 'Internal server error' });
                } else {res.status(200).json({ message: 'User details updated successfully' });
            
            }});
        }
    });
});
app.get('/editUser',(req,res)=>{
    const query3='SELECT * FROM api_access';
    db.query(query,(error,results)=>{
        if(error){
            console.error('Error fetching API subscibers:',error);
            res.status(500).json({ error: 'Internal server error' });
        } else {
            res.json(results); 
        }
    });
});
const PORT = 3000;
app.listen(PORT, () => {
    console.log(`Server is running on port ${PORT}`);
});