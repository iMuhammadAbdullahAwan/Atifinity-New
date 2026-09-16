<?php
/**
 * Template part for displaying sticky sidebar for single posts
 */

$content = get_the_content();
$toc_items = function_exists('atifinity_get_toc') ? atifinity_get_toc($content) : [];
$service_cta = function_exists('atifinity_get_service_cta') ? atifinity_get_service_cta() : null;
?>
<aside class="hidden lg:block lg:w-72 xl:w-80 shrink-0">
    <div class="sticky top-28">
        <?php if (!empty($toc_items) && count($toc_items) >= 3) : ?>
            <div id="toc" class="border border-ink/10 rounded-md p-5 bg-surface/50">
                <h4 class="font-mono text-[11px] uppercase tracking-[0.16em] text-ink-muted/70 mb-4">In this article</h4>
                <ul class="flex flex-col">
                    <?php foreach ($toc_items as $item) : ?>
                        <li class="py-1.5 <?php echo esc_attr($item['level'] === 3 ? 'pl-4' : ''); ?>">
                            <a href="#<?php echo esc_attr($item['id']); ?>" class="text-small text-ink-muted hover:text-ink transition-colors">
                                <?php echo esc_html($item['text']); ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <?php if ($service_cta) : ?>
            <div class="border border-ink/10 rounded-md p-5 bg-surface/50 mt-6">
                <span class="font-mono text-[11px] uppercase tracking-[0.16em] text-ink-muted/70">Related Service</span>
                <h3 class="text-h3 mt-2"><?php echo esc_html($service_cta['service']); ?></h3>
                <p class="text-small text-ink-muted mt-2"><?php echo esc_html($service_cta['description']); ?></p>
                <a href="<?php echo esc_url($service_cta['url']); ?>" class="btn-primary btn-sm mt-4 inline-flex">Learn More</a>
            </div>
        <?php endif; ?>
    </div>
</aside>
