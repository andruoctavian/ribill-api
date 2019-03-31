let db = require('./database.js');

async function main() {
    // await db.service.list();
    // let services = [{
    //     name: 'metric1',
    //     method: 'POST',
    //     URL: '/test/lala'
    // }];

    //await db.service.addMetric('metricks22', '5ca0d18dcfbe7fd82acb259a', 'POST', 'randomurl');
    let list = await db.service.listMetrics('5ca0d18dcfbe7fd82acb259a');
    console.log(list)
}

main();