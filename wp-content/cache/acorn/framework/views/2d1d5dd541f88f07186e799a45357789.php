<?php if(! post_password_required()): ?>
  <section id="comments" class="comments">
    <?php if($responses): ?>
      <h2>
        <?php echo $title; ?>

      </h2>

      <ol class="comment-list">
        <?php echo $responses; ?>

      </ol>

      <?php if($paginated): ?>
        <nav aria-label="Comment">
          <ul class="pager">
            <?php if($previous): ?>
              <li class="previous">
                <?php echo $previous; ?>

              </li>
            <?php endif; ?>

            <?php if($next): ?>
              <li class="next">
                <?php echo $next; ?>

              </li>
            <?php endif; ?>
          </ul>
        </nav>
      <?php endif; ?>
    <?php endif; ?>

    <?php if($closed): ?>
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
        <?php echo __('Comments are closed.', 'sage'); ?>

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
    <?php endif; ?>

    <?php (comment_form()); ?>
  </section>
<?php endif; ?>
<?php /**PATH /var/www/html/wp-content/themes/maryfortuna/resources/views/partials/comments.blade.php ENDPATH**/ ?>