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

//Get list of all companies
router.get('/', authenticateToken,(req,res)=>{
    const user = req.session.user
  
    if (!user) {
      return res.status(401).json({ message: 'Unauthorized. Please login to access the data.' })
    }

    connection.query(
        "SELECT `Company_ID`, `Company_Name`, `Company_Email`, `Company_Phone`, `Status` FROM `company`",
        [],
        (error,results)=>{
            if (error) return res.json({error: error})
            res.json(results)
        })
    //res.json(users)
})

//Get company by id
router.get('/id/:id', authenticateToken, (req,res)=>{
    console.log(req.params.id)
    const user = req.session.user
  
    if (!user) {
      return res.status(401).json({ message: 'Unauthorized. Please login to access the data.' })
    }

    connection.query(
        "SELECT `Company_ID`, `Company_Name`, `Company_Email`, `Company_Phone`, `Status` FROM `company` WHERE `Company_ID`= ? ",
        [req.params.id],
        (error,results)=>{
        if (error) return res.json({error: error})
        res.json(results)
    })
    //res.json(users)
})


//Get company by email
router.get('/email/:email', authenticateToken, (req,res)=>{
    console.log(req.params.email)
    const user = req.session.user
  
    if (!user) {
      return res.status(401).json({ message: 'Unauthorized. Please login to access the data.' })
    }

    connection.query(
        "SELECT `Company_ID`, `Company_Name`, `Company_Email`, `Company_Phone`, `Status` FROM `company` WHERE `Company_Email` =  ? ",
        [req.params.email],
        (error,results)=>{
        if (error) return res.json({error: error})
        res.json(results)
    })
    //res.json(users)
})

//Get company by drug produced
router.get('/drugs-produced/:id', authenticateToken, (req,res)=>{
    console.log(req.params.id)
    const user = req.session.user
  
    if (!user) {
      return res.status(401).json({ message: 'Unauthorized. Please login to access the data.' })
    }

    connection.query(
        "SELECT * FROM drugs d WHERE d.Drug_Company = ? ",
        [req.params.id],
        (error,results)=>{
        if (error) return res.json({error: error})
        res.json(results)
    })
    //res.json(users)
})


//Get patients by last login time




// //Get pharmacy by drug dispensed
// router.get('/drug/:drug', (req,res)=>{
//     console.log(req.params.drug)

//     if (!isNaN(parseInt(req.params.drug))) {
//         connection.query(
//             "SELECT p.`Patient_SSN`, p.`Patient_Name`, p.`Patient_Address`, p.`Patient_Email`, p.`Patient_Phone`, p.`Patient_Gender`, p.`Patient_DOB`, p.`Patient_Age`, p.`Status` FROM `patients` p INNER JOIN prescriptions pr ON p.Patient_SSN = pr.Patient_SSN INNER JOIN drugs d ON pr.Drug_ID = d.Drug_ID WHERE d.Drug_ID = ? AND pr.Prescribed = 'Y'",
//             [req.params.drug],
//             (error,results)=>{
//             if (error) return res.json({error: error})
//             res.json(results)
//         })

//       } else {
//         connection.query(
//             "SELECT p.`Patient_SSN`, p.`Patient_Name`, p.`Patient_Address`, p.`Patient_Email`, p.`Patient_Phone`, p.`Patient_Gender`, p.`Patient_DOB`, p.`Patient_Age`, p.`Status` FROM `patients` p INNER JOIN prescriptions pr ON p.Patient_SSN = pr.Patient_SSN INNER JOIN drugs d ON pr.Drug_ID = d.Drug_ID WHERE d.Drug_Name = ? AND pr.Prescribed = 'Y'",
//             [req.params.drug],
//             (error,results)=>{
//             if (error) return res.json({error: error})
//             res.json(results)
//         })
//       }
// })

// //Get pharmacy by date of drug purchase






module.exports = router