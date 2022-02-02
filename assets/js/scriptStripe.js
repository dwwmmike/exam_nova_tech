$(function(){
    const stripe = Stripe("pk_test_51IM8ZTHlq7zZEqVguY6k81rOCI4VimwjvApVIlI2aJ4sGe3MFVTiyDsUYHVafzwMSlaSusHipYOU9kf0zzXIkuqf003AKpuYvS");
    const checkoutButton = $('#checkout-button');

    checkoutButton.on('click', function(e){
        e.preventDefault();
        console.log($('#nb').val());
        $.ajax({
            url:'index.php?action=pay',
            method:'post',
            data:{
               
                prix: $('#prix').val(),
                email: $('#email').val(),
               
            },
            datatype: 'json',
            success:function(session){
                console.log(session);
                return stripe.redirectToCheckout({ sessionId: session.id });
            },
            error: function(){
                console.error("fail to send!");
            }
        });
    })
});
