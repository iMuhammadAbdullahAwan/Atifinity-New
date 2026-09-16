<?php
/**
 * Template part for displaying service CTA banner at the end of article
 */

$service_cta = function_exists('atifinity_get_service_cta') ? atifinity_get_service_cta() : null;

if ($service_cta) :
?>
<section class="mt-16 pt-12 border-t border-ink/10">
    <div class="rounded-md border border-ink/10 bg-surface/50 p-8 sm:p-10 relative overflow-hidden">
        <div class="glow-edge absolute inset-0 pointer-events-none"></div>
        <div class="relative z-10 flex flex-col items-start">
            <span class="font-mono text-[11px] uppercase tracking-[0.16em] text-ink-muted/70">Need help with this?</span>
            <h2 class="text-h3 mt-3"><?php echo esc_html($service_cta['service']); ?></h2>
            <p class="text-body text-ink-muted mt-3 max-w-xl"><?php echo esc_html($service_cta['description']); ?></p>
            
            <a href="https://wa.me/923488164928" data-wa-text="Hi, I would like to book a strategy call regarding <?php echo esc_attr($service_cta['service']); ?>" class="btn-primary mt-6 inline-flex" target="_blank" rel="noopener noreferrer">
                Book a Strategy Call
            </a>
            
            <a href="<?php echo esc_url($service_cta['url']); ?>" class="text-small text-ink-muted hover:text-ink mt-4 inline-block transition-colors">
                Or explore our services →
            </a>
        </div>
    </div>
</section>
<?php endif; ?>
