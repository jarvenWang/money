<link rel="stylesheet" href="../bower_components/bootstrap/bootstrap.min.css">
<?php if($paginator->hasPages()): ?>
    <center>
    <ul class="pagination">
        <!-- Previous Page Link -->
        <?php if($paginator->onFirstPage()): ?>
            <li><span style="cursor:pointer;" >首页</span></li>
        <?php else: ?>
            <li><a class="direction" render="<?php echo e($paginator->previousPageUrl()); ?>" rel="prev" style="cursor:pointer;" >上一页</a></li>
        <?php endif; ?>

        <!-- Pagination Elements -->
        <?php $__currentLoopData = $elements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
            <!-- "Three Dots" Separator -->
            <?php if(is_string($element)): ?>
                <li class="disabled"><span><?php echo e($element); ?></span></li>
            <?php endif; ?>

            <!-- Array Of Links -->
            <?php if(is_array($element)): ?>
                <?php $__currentLoopData = $element; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                    <?php if($page == $paginator->currentPage()): ?>
                        <li class="active"><span  style="cursor:pointer;background-color:#AF0000;border:1px solid #AF0000"><?php echo e($page); ?></span></li>
                    <?php else: ?>
                        <li><a class="direction" style="cursor:pointer;" render="<?php echo e($url); ?>"><?php echo e($page); ?></a></li>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>

        <!-- Next Page Link -->
        <?php if($paginator->hasMorePages()): ?>
            <li><a class="direction" style="cursor:pointer;"  render="<?php echo e($paginator->nextPageUrl()); ?>" rel="next">下一页</a></li>
        <?php else: ?>
            <li class="disabled"><span style="cursor:pointer;" >尾页</span></li>
        <?php endif; ?>
    </ul>
        </center>
<?php endif; ?>

