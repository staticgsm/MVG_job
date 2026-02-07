<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redirecting to Payment Gateway...</title>
    <style>
        body { font-family: sans-serif; display: flex; justify-content: center; align-items: center; height: 100vh; background-color: #f8f9fa; }
        .message { text-align: center; }
    </style>
</head>
<body onload="document.forms['payu_form'].submit()">
    <div class="message">
        <h2>Redirecting to PayU...</h2>
        <p>Please do not refresh the page.</p>
        <form name="payu_form" action="{{ $params['action'] }}" method="POST">
            <input type="hidden" name="key" value="{{ $params['key'] }}" />
            <input type="hidden" name="txnid" value="{{ $params['txnid'] }}" />
            <input type="hidden" name="amount" value="{{ $params['amount'] }}" />
            <input type="hidden" name="productinfo" value="{{ $params['productinfo'] }}" />
            <input type="hidden" name="firstname" value="{{ $params['firstname'] }}" />
            <input type="hidden" name="email" value="{{ $params['email'] }}" />
            <input type="hidden" name="phone" value="{{ $params['phone'] }}" />
            <input type="hidden" name="surl" value="{{ $params['surl'] }}" />
            <input type="hidden" name="furl" value="{{ $params['furl'] }}" />
            <input type="hidden" name="hash" value="{{ $params['hash'] }}" />
            <!-- UDFs -->
            <input type="hidden" name="udf1" value="{{ $params['udf1'] }}" />
            <input type="hidden" name="udf2" value="{{ $params['udf2'] }}" />
            <input type="hidden" name="udf3" value="{{ $params['udf3'] }}" />
            <input type="hidden" name="udf4" value="{{ $params['udf4'] }}" />
            <input type="hidden" name="udf5" value="{{ $params['udf5'] }}" />
        </form>
    </div>
</body>
</html>
