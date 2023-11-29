const express = require('express')
const router = express.Router()
const mysql2 = require('mysql2')
const session = require('express-session')
const jwt = require('jsonwebtoken')

//Creating a connection to our database
const connection = mysql2.createConnection({
    host: "localhost",
    user : "root",
    password: "",
    database: "dailypharma2" 
})

try {
    connection.connect()
    
} catch (e) {
    console.log("Connection to MySQL failed!")
    console.log(e)
}

// Use express-session middleware
router.use(session({
    secret: 'c75ue5wsh8syozant1to5', // Change this to a strong, secure secret key
    resave: false,
    saveUninitialized: true,
}));

//Function to authenticate whether an endpint has the necessay access token
function authenticateToken(req, res, next) {
    const authHeader = req.headers['authorization'];
    const token = authHeader && authHeader.split(' ')[1];

    if (token == null) {
        return res.status(401).json({ message: 'Authorization Failed. Token Not Available' });
    }

    jwt.verify(token, process.env.ACCESS_TOKEN_SECRET, (err, userData) => {
        if (err) return res.status(403).json({ message: 'Token verification failed' });
        req.session.user = userData; // Store user data in session for later use
        next();
    });
}

//Get list of all doctors
router.get('/', authenticateToken, (req,res)=>{
    const user = req.session.user
  
    if (!user) {
      return res.status(401).json({ message: 'Unauthorized. Please login to access the data.' })
    }

    connection.query("SELECT `Doctor_SSN`, `Doctor_Name`, `Doctor_Phone`, `Doctor_Speciality`, `Doctor_Experience`,`Status` FROM `doctors`",  [], (error,results)=>{
        if (error) return res.json({error: error})
        res.json(results)
    })
    //res.json(users)
})

//Get doctors by ssn
router.get('/ssn/:ssn',  authenticateToken, (req,res)=>{
    console.log(req.params.ssn)
    const user = req.session.user
  
    if (!user) {
      return res.status(401).json({ message: 'Unauthorized. Please login to access the data.' })
    }

    connection.query("SELECT `Doctor_SSN`, `Doctor_Name`, `Doctor_Phone`, `Doctor_Speciality`, `Doctor_Experience`,`Status` FROM `doctors` WHERE `Doctor_SSN` = ? ",
    [req.params.ssn],
    (error,results)=>{
        if (error) return res.json({error: error})
        res.json(results)
    })
    //res.json(users)
})

//Get doctors by speciality
router.get('/speciality/:speciality',  authenticateToken, (req,res)=>{
    console.log(req.params.speciality)
    const user = req.session.user
  
    if (!user) {
      return res.status(401).json({ message: 'Unauthorized. Please login to access the data.' })
    }
    connection.query("SELECT `Doctor_SSN`, `Doctor_Name`, `Doctor_Phone`, `Doctor_Speciality`, `Doctor_Experience`,`Status` FROM `doctors` WHERE `Doctor_Speciality` = ? ",
    [req.params.speciality],
    (error,results)=>{
        if (error) return res.json({error: error})
        res.json(results)
    })
    //res.json(users)
})

//Get doctors by experience
router.get('/experience/:experience',  authenticateToken, (req,res)=>{
    console.log(req.params.experience)
    const user = req.session.user
  
    if (!user) {
      return res.status(401).json({ message: 'Unauthorized. Please login to access the data.' })
    }
    connection.query("SELECT `Doctor_SSN`, `Doctor_Name`, `Doctor_Phone`, `Doctor_Speciality`, `Doctor_Experience`,`Status` FROM `doctors` WHERE `Doctor_Experience` = ? ",
    [req.params.experience],
    (error,results)=>{
        if (error) return res.json({error: error})
        res.json(results)
    })
    //res.json(users)
})

//Get users by last login time

module.exports = router