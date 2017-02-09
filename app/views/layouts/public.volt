{% set level = 'public' %}

{% include "/components/Header.volt" %}

<main class="container">
  {{ content() }}
</main>

{% include "/components/Footer.volt" %}