const express = require('express');
const router = express.Router();
const bcrypt = require('bcrypt');
const jwt = require('jsonwebtoken');
const { db, userSchema } = require('./api_data');

router.post('/register', async (req, res) => {
    try {
        const { id_ssn, User_type, password } = req.body;
        const hashedPassword = await bcrypt.hash(password, 10);

        const insertApiAccessQuery = `
            INSERT INTO api_access (id_ssn, User_type, Drugs, Patients, Doctors, Pharmacies, Company, Password, token, specific_token) 
            VALUES (?, ?, 'pending', 'pending', 'pending', 'pending', 'pending', ?, 'pending', 'pending')
        `;

        db.query(insertApiAccessQuery, [id_ssn, User_type, hashedPassword], (errApiAccess) => {
            if (errApiAccess) {
                console.error('Error inserting data into api_access table:', errApiAccess);
                res.status(500).json({ error: 'Internal server error' });
            } else {
                const insertApiAccessRequestQuery = `
                    INSERT INTO api_access_request (ID_SSN, User_type, Resource_requested)
                    VALUES (?, ?, 'pending')
                `;
                db.query(insertApiAccessRequestQuery, [id_ssn, User_type], (errApiAccessRequest) => {
                    if (errApiAccessRequest) {
                        console.error('Error inserting data into api_access_request table', errApiAccessRequest);
                        res.status(500).json({ error: 'Internal server' });
                    } else {
                        res.status(201).json({ message: 'User registered successfully' });
                    }
                });
            }
        });
    } catch (error) {
        console.error(error);
        res.status(500).json({ error: 'Internal server error' });
    }
});

router.get('/login', async (req, res) => {
    try {
        const { id_ssn, User_type, password } = req.body;

        const checkApi = `
            SELECT * FROM api_access_request 
            WHERE id_ssn=? AND User_type=? AND Resource_requested='allowed'
        `;

        db.query(checkApi, [id_ssn, User_type], async (errCheck, results) => {
            if (errCheck) {
                console.error('Error checking api request:', errCheck);
                res.status(500).json({ error: 'Internal server error' });
            } else {
                if (results.length > 0) {
                    const confirmApi = `
                        SELECT * FROM api_access 
                        WHERE id_ssn=? AND User_type=? 
                    `;
                    db.query(confirmApi, [id_ssn, User_type], async (confirmApiError, confirmResults) => {
                        if (confirmApiError) {
                            console.error('Error confirming api_access:', confirmApiError);
                            res.status(500).json({ error: 'Internal server error' });
                        } else {
                            let match = false;
                            if (confirmResults.length > 0) {
                                const match = await bcrypt.compare(password, confirmResults[0].Password);
                                if (match) {
                                    res.status(200).json({ message: 'User login successful' });
                                    window.location.href="user.html";
                                } else {
                                    res.status(401).json({ error: 'Invalid credentials' });
                                }
                            } else {
                                res.status(404).json({ error: 'User not found' });
                            }
                        }
                    });
                } else {
                    res.status(401).json({ error: 'User not allowed' });
                }
            }
        });
    } catch (error) {
        console.error(error);
        res.status(500).json({ error: 'Internal server error' });
    }
});

module.exports = router;