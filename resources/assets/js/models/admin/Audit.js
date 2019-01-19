class Audit{
    static get(params, then) {
        axios.get('/api/admin/audits', {
            params: params
        })
        .then(({data}) => then(data));
    }

    static show(element, then) {
        axios.get('/api/admin/audits/' + element)
            .then(({data}) => then(data));
    }

    static store(data, then, error) {
        axios.post('/api/admin/audits', data)
            .then(({data}) => then(data))
            .catch(({response}) => error(response.data.errors));
    }

    static update(element, data, then, error) {
        axios.put('/api/admin/audits/'+element, data)
            .then(({data}) => then(data))
            .catch(({response}) => error(response.data.errors));
    }

    static destroy(element, then) {
        axios.delete('/api/admin/audits/' + element)
            .then(({data}) => then(data));
    }

}

export default Audit;