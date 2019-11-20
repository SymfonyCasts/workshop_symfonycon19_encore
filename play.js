const Conference = require('./conference');

const sfCon = new Conference('SymfonyCon 2019');

sfCon.printNameLater()
    .then((data) => {
        console.log('callback!');
        console.log(data);

        return new Promise((resolve, reject) => {
            setTimeout(() => {
                resolve(data * 100);
            }, 2000)
        });
    })
    .then((data) => {
        console.log(data);
    });
console.log('Done!');
