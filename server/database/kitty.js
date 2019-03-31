const mongoose = require('mongoose');
const validator = require('validator');

var kittySchema = new mongoose.Schema({
    name: String
});

kittySchema.methods.speak = function () {
    var greeting = this.name
        ? "Meow name is " + this.name
        : "I don't have a name";
    console.log(greeting);
}

var Kitten = mongoose.model('Kitten', kittySchema);


function create(name){
    var fluffy = new Kitten({ name: name });
    return fluffy.save();
}

function list(){
    Kitten.find(function (err, kittens) {
        if (err) return console.error(err);
        console.log(kittens);
    });
}

const kitty = {
    create,
    list
};

module.exports = kitty;
