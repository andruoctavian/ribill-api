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

const Metric = mongoose.model('Metric', metricSchema);
const Service = mongoose.model('Service', serviceSchema);


function create(giveName, giveMetrics) {
    let service = (giveMetrics)
        ? new Service({ name: giveName, metrics: giveMetrics })
        : new Service({ name: giveName });
    return service.save();
}

async function list(skip = 0, limit = 0) {
    let serviceList = [];
    let obj = {
        id: undefined,
        name: ''
    };
    await Service.find(function (err, services) {

        if (err) return console.error(err);


        for (let service of services) {
            obj = {};
            obj.id = service.id;
            obj.name = service.name;
            serviceList.push(obj);

        }
    }).skip(parseInt(skip)).limit(parseInt(limit));
    //console.log(serviceList)
    return serviceList;
}

function findServiceById(id) {
    return Service.findById(id);
}

async function addMetric(name, serviceId, method, URL) {
    let service = await findServiceById(serviceId);
    let metric = new Metric({ name: name, method: method, URL: URL });
    service.metrics.push(metric);

    return service.save();
}

async function listMetrics(serviceId){
    let metrics = []
    let service = await findServiceById(serviceId);
    

    for (metric of service.metrics){
        
        metrics.push({id: metric.id, name: metric.name, method:metric.method, url: method.URL});
    }

    
    return metrics;
}

const service = {
    create,
    list,
    addMetric,
    listMetrics
};

module.exports = service;