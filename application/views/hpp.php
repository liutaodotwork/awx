<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
    </head>
    <body>
<h1>Hosted payment page (HPP) integration</h1>
    <p>
      The following button redirects the customer to an Airwallex payment page.
    </p>
    <!-- STEP #3: Add a checkout button -->
    <button id="hpp">Pay Now</button>
<script src="https://checkout.airwallex.com/assets/elements.bundle.min.js"></script>
    <script>
      const intent_id = 'replace-with-your-intent-id';
      const client_secret = 'replace-with-your-client-secret';
      const currency = 'replace-with-your-currency';
      const mode = 'payment'; // Should be one of ['payment', 'recurring']

      // STEP #2: Initialize the Airwallex package with the appropriate environment
      Airwallex.init({
        env: 'demo', // Setup which Airwallex env('staging' | 'demo' | 'prod') to integrate with
        origin: window.location.origin, // Setup your event target to receive the browser events message
      });

      const redirectHppForCheckout = () => {
        Airwallex.redirectToCheckout({
          env: 'demo',
          mode: 'payment',
          currency: 'usd',
          autoCapture: false,
          intent_id:'int_hkdm5zz2jg2p0i1nnn9', // Required, must provide intent details
          client_secret:'eyJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE2MzI1NjE3MjEsImV4cCI6MTYzMjU2NTMyMSwiYWNjb3VudF9pZCI6ImVkZjc0YzJmLTMyNzQtNDhkNy1hNDhhLWFkMmQzNzM4YTNkMyIsImRhdGFfY2VudGVyX3JlZ2lvbiI6IkhLIiwiaW50ZW50X2lkIjoiaW50X2hrZG01enoyamcycDBpMW5ubjkiLCJwYWRjIjoiSEsifQ.7HJfH6gvxqAGgcF6u19Vmzmuqer7DQ3zTsv4O1MWbFo', // Required
          successUrl: 'https://www.google.com', // Must be HTTPS sites
          failUrl: 'https://www.google.com', // Must be HTTPS sites
          // For more detailed documentation at https://github.com/airwallex/airwallex-payment-demo/tree/master/docs#redirectToCheckout
        });
      }


      document.getElementById('hpp').addEventListener('click', () => {
        // STEP #4: Add a button handler to trigger the redirect to HPP
        if (mode === 'payment') {
          redirectHppForCheckout();
        } else if (mode === 'recurring') {
          redirectHppForRecurring();
        }
      });
    </script>
    </body>
</html>
