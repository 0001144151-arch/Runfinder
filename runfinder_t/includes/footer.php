<?php
// includes/footer.php - Footer melhor estilizado e responsivo
$me = current_user();
?>
  </main>

  <footer class="site-footer" role="contentinfo">
    <div class="wrap footer-top">
      <!-- Institutional / Brand -->
      <div class="footer-col footer-brand">
        <a class="brand" href="index.php" aria-label="RunFider">
          <svg viewBox="0 0 48 48" aria-hidden="true" focusable="false"><rect width="48" height="48" rx="10" fill="#e31b23"></rect><path d="M12 32 L20 12 L28 32 Z" fill="#fff"/></svg>
          <div style="margin-left:10px">
            <div class="brand-name">RunFider</div>
            <div class="brand-sub small">Dark+ — Corridas, rotas e comunidade runner</div>
          </div>
        </a>

        <p class="brand-desc" style="margin-top:12px;">
          Plataforma completa para organizadores e corredores: crie eventos, trace rotas, publique conteúdo e gerencie inscrições com facilidade.
        </p>

        <div class="footer-socials" style="margin-top:12px;">
          <a class="social-link" href="#" aria-label="Instagram" title="Instagram"><svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M7 2h10a5 5 0 015 5v10a5 5 0 01-5 5H7a5 5 0 01-5-5V7a5 5 0 015-5z" stroke="currentColor" stroke-width="1.2"/></svg></a>
          <a class="social-link" href="#" aria-label="Tiktok" title="Tiktok"><svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M22 12a10 10 0 10-11.5 9.9V14.7h-2.3v-2.7h2.3V9.8c0-2.3 1.4-3.6 3.4-3.6.98 0 2 .18 2 .18v2.2h-1.12c-1.1 0-1.45.69-1.45 1.4v1.7h2.5l-.4 2.7h-2.1v7.2A10 10 0 0022 12z" stroke="currentColor" stroke-width="0.6"/></svg></a>
          <a class="social-link" href="#" aria-label="WhatsApp" title="WhatsApp"><svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M23 7s-.2-1.6-.8-2.3C21 4 20 .9 12 1 4 .9 3 4 1.8 4.7.2 5.9 0 7 0 7s0 1.4 0 2.9v2.2C0 14.6.2 16 1.8 17.3 3 18 4 21 12 21c8 0 9-3 10.2-3.7.6-.4.8-2.3.8-2.3V7z" stroke="currentColor" stroke-width="0.6"/></svg></a>
        </div>
      </div>

      <!-- Quick Links -->
      <div class="footer-col footer-links">
        <h4>Links rápidos</h4>
        <ul style="list-style:none;padding:0;margin:0">
          <li style="margin-bottom:8px;"><a href="index.php">Eventos</a></li>
          <li style="margin-bottom:8px;"><a href="blogs.php">Blogs</a></li>
          <li style="margin-bottom:8px;"><a href="plan.php">Planos</a></li>
          <?php if ($me && $me['role'] === 'organizador'): ?>
            <li style="margin-bottom:8px;"><a href="create_event.php">Criar evento</a></li>
            <li style="margin-bottom:8px;"><a href="my_events.php">Meus eventos</a></li>
          <?php else: ?>
            <li style="margin-bottom:8px;"><a href="register.php">Registrar</a></li>
            <li style="margin-bottom:8px;"><a href="login.php">Entrar</a></li>
          <?php endif; ?>
        </ul>
      </div>

      <!-- Informativo -->
      <div class="footer-col footer-info">
        <h4>Informações</h4>
        <p class="small" style="margin:0 0 8px 0;">Belo Horizonte, Minas Gerais — Brasil</p>
        <p class="small" style="margin:0 0 8px 0;">E-mail: <a href="mailto:contato@runfider.example">contato@runfider.example</a></p>
        <p class="small" style="margin:0 0 8px 0;">Suporte: <a href="mailto:suporte@runfider.example">suporte@runfider.example</a></p>
        <p class="small" style="margin:0;">Horário: Seg–Sex, 09:00–18:00</p>
      </div>

      <!-- Corporate / Newsletter -->
      <div class="footer-col footer-corporate">
        <h4>Newsletter</h4>
        <p class="small">Receba novidades, dicas e anúncios de eventos direto no seu e-mail.</p>
        <form method="post" action="index.php" class="newsletter-form" style="margin-top:8px;">
          <label for="newsletter_email" class="sr-only">E-mail</label>
          <input id="newsletter_email" name="newsletter_email" type="email" placeholder="Seu e-mail" required>
          <button class="btn" type="submit" style="padding:0.56rem 0.9rem;border-radius:10px">Inscrever</button>
        </form>

        <div style="margin-top:14px;">
          <h4>Corporativo</h4>
          <p class="small">Oportunidades de patrocínio e parcerias: <a href="mailto:parcerias@runfider.example">parcerias@runfider.example</a></p>
          <a class="btn-ghost" href="#" style="display:inline-block;margin-top:8px;padding:0.46rem 0.9rem;border-radius:10px">Área Corporativa</a>
        </div>
      </div>
    </div>

    <div class="wrap footer-bottom" style="align-items:center;justify-content:space-between;">
      <div class="bottom-left">
        <p class="small">© RunFider 2025 — Todos os direitos reservados</p>
      </div>
      <div class="bottom-right">
        <ul class="legal-links" style="display:flex;gap:12px;">
          <li><a href="#">Termos</a></li>
          <li><a href="#">Privacidade</a></li>
          <li><a href="#">Contato</a></li>
        </ul>
      </div>
    </div>

    <button id="backToTop" aria-label="Voltar ao topo" title="Topo">↑</button>
  </footer>

  <script>
    document.getElementById('backToTop').addEventListener('click', function(){
      window.scrollTo({top:0, behavior:'smooth'});
    });
  </script>
</body>
</html>