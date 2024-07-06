// Pay Amount
jQuery(document).ready(function($) {
    jQuery('#PayNow').click(function(e) {
        e.preventDefault(); // Prevent the default form submission

        let billing_name = $('#billing_name').val();
        let billing_mobile = $('#billing_mobile').val();
        let billing_email = $('#billing_email').val();
        let shipping_name = $('#billing_name').val(); //  using billing_name for shipping_name
        let shipping_mobile = $('#billing_mobile').val(); // using billing_mobile for shipping_mobile
        let shipping_email = $('#billing_email').val(); // using billing_email for shipping_email
        let paymentOption = "netbanking";
        let payAmount = $('#payAmount').val();

        let request_url = "submitpayment.php";
        let formData = {
            billing_name: billing_name,
            billing_mobile: billing_mobile,
            billing_email: billing_email,
            shipping_name: shipping_name,
            shipping_mobile: shipping_mobile,
            shipping_email: shipping_email,
            paymentOption: paymentOption,
            payAmount: payAmount,
            action: 'payOrder'
        };

        $.ajax({
            type: 'POST',
            url: request_url,
            data: formData,
            dataType: 'json',
            encode: true,
        }).done(function(data) {
            if (data.res === 'success') {
                let orderID = data.order_number;
                let options = {
                    "key": data.razorpay_key, // Enter the Key ID generated from the Dashboard
                    "amount": data.userData.amount, // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
                    "currency": "INR",
                    "name": "Education_TRIP", // Your business name
                    "description": data.userData.description,
                    "order_id": data.userData.rpay_order_id, // This is a sample Order ID. Pass 
                    "handler": function(response) {

                        // yaha regitration form ko redirect kr rhe
                         window.location.replace("http://localhost/fproject/index.html?oid=" + orderID + "&rp_payment_id=" + response.razorpay_payment_id + "&rp_signature=" + response.razorpay_signature);

                        //  yaha detail aa rha
                        // window.location.replace("http://localhost/fproject/payment-success.php?oid=" + orderID + "&rp_payment_id=" + response.razorpay_payment_id + "&rp_signature=" + response.razorpay_signature);
                    },
                    "modal": {
                        "ondismiss": function() {
                             window.location.replace("http://localhost/fproject/index.html?oid=" + orderID);

                            //  yaha output aa rha detail
                            // window.location.replace("http://localhost/fproject/payment-success.php?oid=" + orderID);

                        }
                    },
                    "prefill": { // We recommend using the prefill parameter to auto-fill customer's contact information especially their phone number
                        "name": data.userData.name, // Your customer's name
                        "email": data.userData.email,
                        "contact": data.userData.mobile // Provide the customer's phone number for better conversion rates 
                    },
                    "notes": {
                        "address": "VNIT NAGPUR"
                    },
                    "config": {
                        "display": {
                            "blocks": {
                                "banks": {
                                    "name": 'Pay using ' + paymentOption,
                                    "instruments": [
                                        {
                                            "method": paymentOption
                                        },
                                    ],
                                },
                            },
                            "sequence": ['block.banks'],
                            "preferences": {
                                "show_default_blocks": true,
                            },
                        },
                    },
                    "theme": {
                        "color": "#3399cc"
                    }
                };
                let rzp1 = new Razorpay(options);
                rzp1.on('payment.failed', function(response) {
                     window.location.replace("http://localhost/fproject/index.html?oid=" + orderID + "&reason=" + response.error.description + "&paymentid=" + response.error.metadata.payment_id);
                    // window.location.replace("http://localhost/fproject/payment-failed.php?oid=" + orderID + "&reason=" + response.error.description + "&paymentid=" + response.error.metadata.payment_id);
                });
                rzp1.open();
            }
        });
    });
});
