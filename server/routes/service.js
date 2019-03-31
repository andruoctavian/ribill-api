const express = require('express');
const app = express.Router();
const db = require('../database/database.js');


app.get('/list', async function(req, res){
    let services = (req.query.skip && req.query.limit) ? await db.service.list(req.query.skip, req.query.limit) : await db.service.list();
    res.send(JSON.stringify(services));
});

app.post('/add', async function(req, res){
    let serviceName = req.body.name;
    try{
        let s = await db.service.create(serviceName);
        res.send(s);
    }
    catch(e){
        res.send(false);
    }
});


module.exports = app;