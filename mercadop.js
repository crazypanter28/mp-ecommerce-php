

$( document ).ready(function() {
    alert("HOLA");
    window.Mercadopago.setPublishableKey("APP_USR-158fff95-0bdf-4149-9abc-c8b0ac7f289f");
    window.Mercadopago.getIdentificationTypes();
});

document.getElementById('cardNumber').addEventListener('change', guessPaymentMethod);

function guessPaymentMethod(event) {
   let cardnumber = document.getElementById("cardNumber").value;
   if (cardnumber.length >= 6) {
       let bin = cardnumber.substring(0,6);
       window.Mercadopago.getPaymentMethod({
           "bin": bin
       }, setPaymentMethod);
   }
};

function setPaymentMethod(status, response) {
   if (status == 200) {
       let paymentMethod = response[0];
       document.getElementById('paymentMethodId').value = paymentMethod.id;

       if(paymentMethod.additional_info_needed.includes("issuer_id")){
           getIssuers(paymentMethod.id);
       } else {
           getInstallments(
               paymentMethod.id,
               document.getElementById('transactionAmount').value
           );
       }
   } else {
       alert(`payment method info error: ${response}`);
   }
}