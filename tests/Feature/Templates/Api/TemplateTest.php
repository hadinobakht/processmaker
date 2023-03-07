<?php

namespace Tests\Feature\Templates\Api;

use DB;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Arr;
use ProcessMaker\Models\Process;
use ProcessMaker\Models\Screen;
use Tests\Feature\Shared\RequestHelper;
use Tests\Feature\Templates\HelperTrait;
use Tests\TestCase;

class TemplateTest extends TestCase
{
    use RequestHelper;
    use HelperTrait;
    use WithFaker;

    public function testSaveModelTemplate()
    {
        $process = $this->createProcess('process-with-task-screen', [
            'name' => 'Test Process',
        ]);
        // TODO: Create Process Screens
        $screen = $this->createProcess('process-with-task-screen', [
            'name' => 'Test Process',
        ]);

        // TODO: Export Process Model
        $options = new Options([$manager->uuid => ['mode' => 'discard']]);

        $response = $this->apiCall(
            'POST',
            route('api.template.store', [
                'type' => 'process',
                'id' => $process->id,
            ]),
            [
                'name' => 'Test Template',
                'description' => 'Test template description',
                'template_category_id' => 1,
                'options' => ['copy'],
                'mode' => 'saveAll',
            ]
        );

        dd($response);

        // $screen = Screen::factory()->create(['title' => 'Screen']);

        // $response = $this->apiCall(
        //     'POST',
        //     route('api.export.download', [
        //         'type' => 'screen',
        //         'id' => $screen->id,
        //     ]),
        //     [
        //         'password' => 'foobar',
        //         'options' => [],
        //     ]
        // );

        // // Ensure we can download the exported file.
        // $response->assertStatus(200);
        // $response->assertHeader('content-disposition', "attachment; filename={$screen->title}.json");

        // // Ensure it's encrypted.
        // $payload = json_decode($response->streamedContent(), true);
        // $this->assertEquals(true, $payload['encrypted']);

        // $headers = $response->headers;
        // $exportInfo = json_decode($headers->get('export-info'), true)['exported'];
        // $this->assertCount(1, $exportInfo['Screen']['ids']);
        // $this->assertEquals($screen->id, $exportInfo['Screen']['ids'][0]);
        // $this->assertCount(1, $exportInfo['ScreenCategory']['ids']);
        // $this->assertEquals($screen->categories[0]->id, $exportInfo['ScreenCategory']['ids'][0]);
    }
}
