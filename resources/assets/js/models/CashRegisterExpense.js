class CashRegisterExpense {
    static get(params, then) {
        axios.get('/api/cash-register-expenses', {
            params: params
        })
        .then(({data}) => then(data));
    }

    static store(data, then, error) {
        axios.post('/api/cash-register-expenses', data)
            .then(({data}) => then(data))
            .catch(({response}) => error(response.data.errors));
    }

    static destroy(element, then) {
        axios.delete('/api/cash-register-expenses/' + element)
            .then(({data}) => then(data));
    }

}

export default CashRegisterExpense;