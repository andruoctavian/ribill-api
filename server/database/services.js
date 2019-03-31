const mongoose = require('mongoose');
const validator = require('validator');

var metricSchema = new mongoose.Schema({
    name: {
        type: String,
        required: true
    },
    method: {
        type: String,
        required: true
    },
    URL: {
        type: String,
        required: true
    }
})

var serviceSchema = new mongoose.Schema({
    name: {
        type: String,
        required: true,
        unique: true
    },
    metrics: {
        type: [metricSchema],
        default: []
    }
});

var Service = mongoose.model('Service', serviceSchema);


function create(giveName, giveMetrics) {
    let service = (giveMetrics) 
        ? new Service({name: giveName, metrics: giveMetrics})
        : new Service({name: giveName});
    return service.save();
}

async function list() {
    let serviceList = [];
    let obj = {};
    await Service.find(function (err, services) {
        
        if (err) return console.error(err);
        console.log(services);

        for (let service of services) {
            obj.id = service.id;
            obj.name = service.name;
            serviceList.push(obj);
        //     console.log('name: ' + service.name);
        //     console.log('metrics:');

        //     for (metric of service.metrics) {
        //         console.log(metric);
        //     }
        }
    });
    return serviceList;
}

const service = {
    create,
    list
};

module.exports = service;