<style>
    .group {
        margin-bottom: 18px;
        border-left: 4px solid transparent;
        padding-left: 10px;
    }

    .group-title {
        font-size: 15px;
        font-weight: bold;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .group-title button {
        font-size: 12px;
        padding: 4px 8px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        background: #e5e7eb;
        color: #111827;
    }

    .group-title button:hover {
        background: #d1d5db;
    }

    /* Custom checkbox */
    .checkbox-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: #f9fafb;
        padding: 10px;
        border-radius: 8px;
        margin-bottom: 6px;
        cursor: pointer;
        transition: background .2s, transform .2s;
    }

    .checkbox-item:hover {
        background: #eef2ff;
        transform: translateX(2px);
    }

    .checkbox-item input {
        display: none;
    }

    .checkmark {
        width: 18px;
        height: 18px;
        border-radius: 5px;
        border: 2px solid #9ca3af;
        display: inline-block;
        margin-right: 10px;
        position: relative;
        transition: border .2s, background .2s;
        top: 4px;
    }

    .checkbox-item input:checked + .checkmark {
        background: var(--accent);
        border-color: var(--accent);
    }

    .checkbox-item input:checked + .checkmark::after {
        content: "✓";
        color: white;
        font-size: 12px;
        position: absolute;
        top: -2px;
        left: 3px;
    }

    .label-text {
        font-size: 14px;
        color: #374151;
        font-weight: 500;
    }

    .group.blue {
        border-color: #3b82f6;
        --accent: #3b82f6;
    }
</style>

<style>

    .card:hover {
        border-color: #cbd5e1; /* darker border on hover */
    }

    .name {
        font-size: 15px;
        font-weight: 600;
        margin-top: 2px;
    }


    .btn svg {
        width: 18px;
        height: 18px;
    }

    .btn-code {
        background: #3b82f6;
        color: white;
    }

    .btn-config {
        background: #10b981;
        color: white;
    }

    .btn-delete {
        background: #ef4444;
        color: white;
    }

    .btn-time {
        background: #efb644;
        color: white;
    }

    .checkbox-item input[type="number"] {
        width: 60px;
        padding: 4px;
        font-size: 13px;
        border: 1px solid #d1d5db;
        border-radius: 6px;
        text-align: center;
        display: block !important;
    }


</style>

<style>
    /* Custom size: 80% width & height */
    .modal-dialog.custom-modal {
        max-width: 80% !important;
        width: 80% !important;
        margin: auto;
    }
    .modal-content {
        height: 100%;
    }
    .modal-body {
        overflow-y: auto;
    }
</style>
