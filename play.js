const Conference = require('./conference');

const sfCon = new Conference('SymfonyCon 2019');

setTimeout(function() {
    console.log(sfCon.name);
}, 500);

console.log('Done!');
