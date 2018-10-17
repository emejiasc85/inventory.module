class CashRegisterDeposit {
    static get(params, then) {
        axios.get('/api/cash-register-deposits', {
            params: params
        })
        .then(({data}) => then(data));
    }

    static store(data, then, error) {
        axios.post('/api/cash-register-deposits', data)
            .then(({data}) => then(data))
            .catch(({response}) => error(response.data.errors));
    }

    static destroy(element, then) {
        axios.delete('/api/cash-register-deposits/' + element)
            .then(({data}) => then(data));
    }

}

export default CashRegisterDeposit;