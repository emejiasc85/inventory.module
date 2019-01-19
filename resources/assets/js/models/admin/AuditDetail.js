class AuditDetail{
    static get(params, then) {
        axios.get('/api/admin/audit-details', {
            params: params
        })
        .then(({data}) => then(data));
    }

    static store(data, then, error) {
        axios.post('/api/admin/audit-details', data)
            .then(({data}) => then(data))
            .catch(({response}) => error(response.data.errors));
    }

    static update(element, data, then, error) {
        axios.put('/api/admin/audit-details/'+element, data)
            .then(({data}) => then(data))
            .catch(({response}) => error(response.data.errors));
    }

    static destroy(element, then) {
        axios.delete('/api/admin/audit-details/' + element)
            .then(({data}) => then(data));
    }

}

export default AuditDetail;