let db = require('./database.js');

async function main() {
    await db.service.list();
    let services = [{
        name: 'metric1',
        method: 'POST',
        URL: '/test/lala'
    }];
    await db.service.create('service3', services)
    await db.service.list();
}

main();