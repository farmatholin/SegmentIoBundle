Usage
=====

Usage as service
----------------

.. code-block:: php

    $analytics = $this->get('segment_io.analytics');
    $analytics->page([])

Usage with Annotations
----------------------

User for annotations is getting from TokenStorage.
If user doesn't exit, id set to 'guest' or from configuration 'guest_id'

.. code-block:: php

    use Farmatholin\SegmentIoBundle\Configuration\Page;
    use Farmatholin\SegmentIoBundle\Configuration\Track;

    /**
     * @Route("/", name="homepage")
     *
     * @Page(
     *     name="index",
     *     category="page",
     *     properties={"foo":"bar"}
     * )
     * @Track(
     *     event="visit homepage",
     *     properties={"bar":"foo"},
     *     useTimestamp=true,
     *     context={"aa":"bb"}
     * )
     */
    public function indexAction(Request $request)
    {
        // your code
    }


Usage with Attributes
----------------------

User for attributes is getting from TokenStorage.
If user doesn't exit, id set to 'guest' or from configuration 'guest_id'

.. code-block:: php

    use Farmatholin\SegmentIoBundle\Configuration\Page;
    use Farmatholin\SegmentIoBundle\Configuration\Track;

    #[Route('/', name: 'homepage')]
    #[Page('index', category: 'page', properties: ['foo' => 'bar'])]
    #[Track('visit homepage', properties: ['bar' => 'foo'], context: ['aa' => 'bb'], useTimestamp: true)]
    public function indexAction(Request $request)
    {
        // your code
    }
