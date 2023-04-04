<style>
  #accept-cookies {
    position: fixed;
    bottom: 10px;
    left: 10px;
    width: 400px;
    max-width: calc(100% - 1rem);
    background-color: white;
    z-index: 99999999;
    padding: 1rem;
    border-radius: 0.4rem;
    box-shadow: 0 0 20px rgba(0, 0, 34, 0.1333333333);
  }
  #accept-cookies .content {
    display: flex;
    flex-direction: column;
  }
  #accept-cookies .content .title-card {
    display: flex;
    align-items: center;
  }
  #accept-cookies .content .title-card strong {
    font-weight: bold;
    font-size: 1.2rem;
    color: var(--primary-500);
  }
  #accept-cookies .content .title-card svg {
    margin-left: 10px;
    color: var(--primary-500);
  }
  #accept-cookies .content a {
    font-size: 0.95rem;
    text-decoration: underline;
    color: var(--gray-500);
  }
  #accept-cookies .content button {
    margin-top: 1rem;
    font-weight: bold;
  }
</style>
<div id="accept-cookies" style="display: none;">
  <div class="content">
      <div class="title-card">
        <strong>Esse site usa cookies</strong>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="20">
          <g>
            <path fill="currentColor"
              d="M510.52 255.81A127.93 127.93 0 0 1 384.05 128 127.92 127.92 0 0 1 256.19 1.51a132 132 0 0 0-79.72 12.81l-69.13 35.22a132.32 132.32 0 0 0-57.79 57.81l-35.1 68.88a132.64 132.64 0 0 0-12.82 81l12.08 76.27a132.56 132.56 0 0 0 37.16 73l54.77 54.76a132.1 132.1 0 0 0 72.71 37.06l76.71 12.15a131.92 131.92 0 0 0 80.53-12.76l69.13-35.21a132.32 132.32 0 0 0 57.79-57.81l35.1-68.88a132.59 132.59 0 0 0 12.91-80zM176 368a32 32 0 1 1 32-32 32 32 0 0 1-32 32zm32-160a32 32 0 1 1 32-32 32 32 0 0 1-32 32zm160 128a32 32 0 1 1 32-32 32 32 0 0 1-32 32z"
              class="fa-secondary" />
            <path fill="#fff"
              d="M368 272a32 32 0 1 0 32 32 32 32 0 0 0-32-32zM208 144a32 32 0 1 0 32 32 32 32 0 0 0-32-32zm-32 160a32 32 0 1 0 32 32 32 32 0 0 0-32-32z" />
          </g>
        </svg>
      </div>
      <p>Nós armazenamos dados temporariamente para melhorar a sua experiencia de navegação e recomendar conteúdo do seu enteresse. Ao utilizar este site você concorda com tal monitoramento.</p>
      <a href="/pages/1" target="_blank">Politica de Privacidade</a>
      <button
        type="button"
        onclick="handleAcceptCookies()"
        class="btn btn-danger"
      >OK</button>
  </div>
</div>
<script>
  $(function(){
    let statCookies = localStorage.getItem("@loja-didoo:accepted_cookies");
    if (!statCookies || statCookies !== 'accepted'){
      $('#accept-cookies').show('slow');
      setTimeout(() => {
        $('#accept-cookies').hide('slow');
      }, 5*1000);
    }
  });

  function handleAcceptCookies() {
    localStorage.setItem('@loja-didoo:accepted_cookies', 'accepted');
    $('#accept-cookies').hide('slow');
  }
</script>