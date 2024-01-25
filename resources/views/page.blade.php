<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>
    
    <div class="container mt-5">
        <div class="row justify-content-around">
            <div class="col-md-5 border">
                  @if(session('error'))
                            <div class="alert alert-danger mt-2">
                                {{ session('error') }}
                            </div>
                        @endif
                         @if(session('success'))
                            <div class="alert alert-succes mt-2">
                                {{ session('success') }}
                            </div>
                        @endif
                        <form id='checkout-form' method='post' action="{{route('store')}}">   
                            @csrf             
                            <input type='hidden' name='stripeToken' id='stripe-token-id'>                              
                            <label for="card-element" class="mb-5 mt-3">Test de paiement avec les clés de production. Vous serez débité d'un montant de 1$.</label>
                            <br>
                            <div id="card-element" class="form-control" ></div>
                            <button 
                                id='pay-btn'
                                class="btn btn-success mt-3 mb-4"
                                type="button"
                                style="margin-top: 20px; width: 100%;padding: 7px;"
                                onclick="createToken()">PAYER 1$
                            </button>
                        <form>
            </div>
            
       
    </div>
   
 
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        var stripe = Stripe('{{ env('STRIPE_KEY') }}')
        var elements = stripe.elements();
        var cardElement = elements.create('card');
        cardElement.mount('#card-element');
  
        function createToken() {
            document.getElementById("pay-btn").disabled = true;
            stripe.createToken(cardElement).then(function(result) {
  
                  
                if(typeof result.error != 'undefined') {
                    document.getElementById("pay-btn").disabled = false;
                    alert(result.error.message);
                }
  
                // creating token success
                if(typeof result.token != 'undefined') {
                    document.getElementById("stripe-token-id").value = result.token.id;
                    document.getElementById('checkout-form').submit();
                }
            });
        }
    </script>
</body>
</html>