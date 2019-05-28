<?php

/*
 * Template Name: Contact Page Template
 * Description: A Page Template for the contact page.
 */



$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;
$context['form'] = do_shortcode( '[contact-form-7 id="26" title="Contact form 1"]' );

Timber::render(['page-contact.twig', 'page.twig'], $context);
