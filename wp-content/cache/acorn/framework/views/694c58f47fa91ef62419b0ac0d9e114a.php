<?php $__env->startSection('content'); ?>
  <?php echo $__env->make('partials.page-header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

  <?php if(! have_posts()): ?>
    <?php if (isset($component)) { $__componentOriginal5194778a3a7b899dcee5619d0610f5cf = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5194778a3a7b899dcee5619d0610f5cf = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.alert','data' => ['type' => 'warning']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('alert'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'warning']); ?>
      <?php echo __('Sorry, no results were found.', 'sage'); ?>

     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5194778a3a7b899dcee5619d0610f5cf)): ?>
<?php $attributes = $__attributesOriginal5194778a3a7b899dcee5619d0610f5cf; ?>
<?php unset($__attributesOriginal5194778a3a7b899dcee5619d0610f5cf); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5194778a3a7b899dcee5619d0610f5cf)): ?>
<?php $component = $__componentOriginal5194778a3a7b899dcee5619d0610f5cf; ?>
<?php unset($__componentOriginal5194778a3a7b899dcee5619d0610f5cf); ?>
<?php endif; ?>

    <?php echo get_search_form(false); ?>

  <?php endif; ?>

  <?php while(have_posts()): ?> <?php (the_post()); ?>
    <?php echo $__env->first(['partials.content-' . get_post_type(), 'partials.content'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
  <?php endwhile; ?>

  <?php echo get_the_posts_navigation(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('sidebar'); ?>
  <?php echo $__env->make('sections.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/wp-content/themes/maryfortuna/resources/views/index.blade.php ENDPATH**/ ?>