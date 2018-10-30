class CreditPayment {
    static update(element, data, then, error) {
        axios.put('/api/invoices/'+element+'/credit-payments', data)
            .then(({data}) => then(data))
            .catch(({response}) => error(response.data.errors));
    }
}
export default CreditPayment;