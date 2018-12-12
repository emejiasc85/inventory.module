class Warehouse{
    static get(params, then) {
        axios.get('/api/admin/warehouses', {
            params: params
        })
        .then(({data}) => then(data));
    }

    static store(data, then, error) {
        axios.post('/api/admin/warehouses', data)
            .then(({data}) => then(data))
            .catch(({response}) => error(response.data.errors));
    }

    static update(element, data, then, error) {
        axios.put('/api/admin/warehouses/'+element, data)
            .then(({data}) => then(data))
            .catch(({response}) => error(response.data.errors));
    }

    static destroy(element, then) {
        axios.delete('/api/admin/warehouses/' + element)
            .then(({data}) => then(data));
    }

}

export default Warehouse;