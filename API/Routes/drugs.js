const express = require('express')
const router = express.Router()
const mysql2 = require('mysql2')

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

//Get a list of all drugs
router.get('/', (req,res)=>{
    connection.query(
        "SELECT `Drug_ID`, `Drug_Name`, `Drug_Description`, `Drug_Category`, `Drug_Image`, `Drug_Quantity`, `Drug_Expiration_Date`, `Drug_Manufacturing_Date`, `Drug_Company` FROM `drugs`",
        [],
        (error,results)=>{
            if (error) return res.json({error: error})
            res.json(results)
        })
    //res.json(users)
})

router.get('/id/:id', (req,res)=>{
    connection.query(
        "SELECT `Drug_ID`, `Drug_Name`, `Drug_Description`, `Drug_Category`, `Drug_Image`, `Drug_Quantity`, `Drug_Expiration_Date`, `Drug_Manufacturing_Date`, `Drug_Company` FROM `drugs` WHERE `Drug_ID` = ? ",
        [req.params.id],
        (err,results)=>{
            if (err) return res.json({error : err})
            res.json(results)
        }
    )
})

router.get('/category/:cat', (req,res)=>{
    connection.query(
        "SELECT `Drug_ID`, `Drug_Name`, `Drug_Description`, `Drug_Category`, `Drug_Image`, `Drug_Quantity`, `Drug_Expiration_Date`, `Drug_Manufacturing_Date`, `Drug_Company` FROM `drugs` WHERE `Drug_Category` = ? ",
        [req.params.cat],
        (err,results)=>{
            if (err) return res.json({error : err})
            res.json(results)
        }
    )
})

module.exports = router