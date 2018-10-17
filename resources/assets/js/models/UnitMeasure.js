class UnitMeasure{
    static get(params, then) {
        axios.get('/api/unit_measures', {
            params: params
        })
        .then(({data}) => then(data));
    }

    static store(data, then, error) {
        axios.post('/api/unit_measures', data)
            .then(({data}) => then(data))
            .catch(({response}) => error(response.data.errors));
    }

    static update(element, data, then, error) {
        axios.post('/api/unit_measures/' + element, data)
            .then(({data}) => then(data))
            .catch(({response}) => error(response.data.errors));
    }

    static destroy(element, then) {
        axios.delete('/api/unit_measures/' + element)
            .then(({data}) => then(data));
    }

}

export default UnitMeasure;