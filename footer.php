<footer class="footer">
    <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All rights reserved.</p>
    <script>
        const startTime = new Date('2024-01-01T00:00:00');
        const currentTime = new Date();
        const diffTime = Math.abs(currentTime - startTime);
        const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)); 
        document.write(`Website has been running smoothly for ${diffDays} days.`);
    </script>
    
</footer>

<?php wp_footer(); ?>
</body>
</html>