<?php

namespace DutchCodingCompany\HetznerDnsClient\RequestCollections;

use DutchCodingCompany\HetznerDnsClient\Requests\Records\BulkCreateRecords;
use DutchCodingCompany\HetznerDnsClient\Requests\Records\BulkUpdateRecords;
use DutchCodingCompany\HetznerDnsClient\Requests\Records\CreateRecord;
use DutchCodingCompany\HetznerDnsClient\Requests\Records\DeleteRecord;
use DutchCodingCompany\HetznerDnsClient\Requests\Records\GetRecord;
use DutchCodingCompany\HetznerDnsClient\Requests\Records\ListRecords;
use DutchCodingCompany\HetznerDnsClient\Requests\Records\UpdateRecord;
use Sammyjo20\Saloon\Http\RequestCollection;

class RecordCollection extends RequestCollection
{
    public function all(...$arguments): array
    {
        return $this->connector->request(new ListRecords(...$arguments))->send()->throw()->json();
    }

    public function create(...$arguments): array
    {
        return $this->connector->request(new CreateRecord(...$arguments))->send()->throw()->json();
    }

    public function get(...$arguments): array
    {
        return $this->connector->request(new GetRecord(...$arguments))->send()->throw()->json();
    }

    public function update(...$arguments): array
    {
        return $this->connector->request(new UpdateRecord(...$arguments))->send()->throw()->json();
    }

    public function delete(...$arguments): array
    {
        return $this->connector->request(new DeleteRecord(...$arguments))->send()->throw()->json();
    }

    public function bulkCreate(...$arguments): array
    {
        return $this->connector->request(new BulkCreateRecords(...$arguments))->send()->throw()->json();
    }

    public function bulkUpdate(...$arguments): array
    {
        return $this->connector->request(new BulkUpdateRecords(...$arguments))->send()->throw()->json();
    }
}
