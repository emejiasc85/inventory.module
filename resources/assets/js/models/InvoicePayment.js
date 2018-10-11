class InvoicePayment {
    static update(element, data, then, error) {
        axios.put('/api/invoices/'+element+'/payments', data)
            .then(({data}) => then(data))
            .catch(({response}) => error(response.data.errors));
    }
}
export default InvoicePayment;