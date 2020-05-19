Getting Started With SegmentIOBundle
====================================

This component for using Segment.io library for analytics.

Installation
------------
Install

.. code-block:: bash

    $ php composer.phar require "farmatholin/segment-io-bundle":"dev-master"

Enable the bundle in the kernel:

.. code-block:: php

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

.. code-block:: yaml

    segment_io:
        write_key: "%your_key%" #add your main source write_key
        sources: # provide the sources if you need to send events to different sources
            - {name: source_name, write_key: key_here} # Here you provide a name and write key for a source
        guest_id: "guest" # default guest. Guest id for annotation Track and Page
        env: prod #default prod. Can be prod (sending to segment) and dev (not sending)
        options:
            consumer: socket #default
            debug: false #default
            ssl: false #default
            max_queue_size: 10000 #default
            batch_size: 100 #default
            timeout: 0.5 #default
            filename: null #default

More about options `Configuration <https://segment.com/docs/libraries/php/#configuration>`_
