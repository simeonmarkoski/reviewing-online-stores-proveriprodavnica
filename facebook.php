<script>
    document.write("<h3>Се чека на екстензијата...</h3>");
    const element = document.createElement('hash');
    element.setAttribute('value', document.location.hash);
    document.body.appendChild(element);
</script>
<noscript>
    <h1><?=Language::Translate("enable_javascript")?></h1>
</noscript>
