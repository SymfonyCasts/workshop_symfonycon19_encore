const Conference = require('./conference');

const sfCon = new Conference('SymfonyCon 2019');

sfCon.printNameLater()
    .then((data) => {
        console.log('callback!');
        console.log(data);
    });
console.log('Done!');
