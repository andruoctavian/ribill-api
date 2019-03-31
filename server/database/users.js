const mongoose = require('mongoose');
const validator = require('validator');

var userSchema = new mongoose.Schema({
    name: {
        type: String,
        required: true,
        unique: true
    },
    services: {
        type: Array,
        default: []
    }
});
var User = mongoose.model('User', userSchema);

function create() {
    let user = arguments[1]
        ? new User({ name: arguments[0], services: [arguments[1]] })
        : new User({ name: arguments[0] });
    return user.save();
}

function list() {
    User.find(function (err, users) {
        if (err) return console.error(err);
        for (let user of users) {
            console.log('username: ' + user.name);
            console.log('sevices:');
            for (metric of user.services) {
                console.log(metric);
            }
        }
    });
}

const user = {
    create,
    list
};

module.exports = user;