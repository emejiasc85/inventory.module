class Make {
    static get(params, then) {
        axios.get('/api/makes', {
            params: params
        })
        .then(({data}) => then(data));
    }

    static store(data, then, error) {
        axios.post('/api/makes', data)
            .then(({data}) => then(data))
            .catch(({response}) => error(response.data.errors));
    }

    static update(element, data, then, error) {
        axios.post('/api/makes/' + element, data)
            .then(({data}) => then(data))
            .catch(({response}) => error(response.data.errors));
    }

    static destroy(element, then) {
        axios.delete('/api/makes/' + element)
            .then(({data}) => then(data));
    }

}

export default Make;