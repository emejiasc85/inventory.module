class CashRegister {
    static get(params, then) {
        axios.get('/api/cash-register', {
            params: params
        })
        .then(({data}) => then(data));
    }

    static store(data, then, error) {
        axios.post('/api/cash-register', data)
            .then(({data}) => then(data))
            .catch(({response}) => error(response.data.errors));
    }

    static show(element, then) {
        axios.get('/api/cash-register/' + element)
            .then(({data}) => then(data));
    }

    static update(element, data, then, error) {
        axios.post('/api/cash-register/' + element, data)
            .then(({data}) => then(data))
            .catch(({response}) => error(response.data.errors));
    }

    static destroy(element, then) {
        axios.delete('/api/cash-register/' + element)
            .then(({data}) => then(data));
    }

}

export default CashRegister;