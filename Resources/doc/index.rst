Getting Started With SegmentIOBundle
====================================

This component for using Segment.io library for analytics.

Installation
------------
Install

.. code-block:: bash

    $ php composer.phar require "farmatholin/segment-io-bundle":"dev-master"

Enable the bundle in the kernel::

    <?php
    // app/AppKernel.php

    public function registerBundles()
    {
        $bundles = array(
            // ...
            new Farmatholin\SegmentIoBundle\SegmentIoBundle(),
            // ...
        );
    }

Configuration
-------------
Configure bundle

.. configuration-block::

    .. code-block:: yaml

        # app/config/config.yml
        segment_io:
            write_key: "%your_key%" #add your key
            options:
                consumer: socket #default
                debug: false #default
                ssl: false #default
                max_queue_size: 10000 #default
                batch_size: 100 #default
                timeout: 0.5 #default
                filename: null #default

More about options `Configuration <https://segment.com/docs/libraries/php/#configuration>`_
