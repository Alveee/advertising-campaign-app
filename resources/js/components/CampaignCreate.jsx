import React, { useState } from "react";
import ReactDOM from "react-dom";
import axios from "axios";
import CreativeInput from "./CreativeInput";

const CampaignCreate = (props) => {
    const [fileCount, setFileCount] = useState(1);
    const [campaignData, setCampaignData] = useState({});
    const [errors, setErrors] = useState({});
    const [errorMessage, setErrorMessage] = useState(null);

    const createCampaign = (event) => {
        event.preventDefault();
        const formData = new FormData();
        for (let key in campaignData) {
            formData.append(key, campaignData[key]);
        }

        axios
            .post("/api/v1/campaigns", formData, {
                headers: {
                    "content-type": "multipart/form-data",
                },
            })
            .then((res) => {
                window.location = "/campaigns";
            })
            .catch((err) => {
                setErrors(err.response.data.errors);
                setErrorMessage(err.response.data.message);
            });
    };

    const handleChange = (event) => {
        let formdata = { ...campaignData };
        if (event.target.type === "file") {
            formdata[event.target.name] = event.target.files[0];
        } else if (event.target.type === "date") {
            formdata[event.target.name] = new Date(event.target.value)
                .toISOString()
                .slice(0, 10);
        } else {
            formdata[event.target.name] = event.target.value;
        }
        setCampaignData(formdata);
    };

    const addMoreFileInput = () => {
        setFileCount(fileCount + 1);
    };

    return (
        <div>
            <div className="row">
                <div className="col-md-12">
                    {errorMessage && (
                        <div className="alert alert-danger">
                            <h6>{errorMessage}</h6>
                        </div>
                    )}
                </div>
            </div>
            <form onSubmit={createCampaign}>
                <div className="mb-3">
                    <label className="form-label">Name</label>
                    <input
                        type="text"
                        name="name"
                        onChange={handleChange}
                        className="form-control"
                        required
                    />
                </div>
                <div className="mb-3">
                    <label className="form-label">From Date</label>
                    <input
                        type="date"
                        name="start_date"
                        onChange={handleChange}
                        className="form-control"
                        required
                    />
                </div>
                <div className="mb-3">
                    <label className="form-label">To Date</label>
                    <input
                        type="date"
                        name="end_date"
                        onChange={handleChange}
                        className="form-control"
                        required
                    />
                </div>
                <div className="mb-3">
                    <label className="form-label">Total Budget</label>
                    <input
                        type="number"
                        name="total_budget"
                        onChange={handleChange}
                        className="form-control"
                        required
                    />
                </div>
                <div className="mb-3">
                    <label className="form-label">Daily Budget</label>
                    <input
                        type="number"
                        name="daily_budget"
                        onChange={handleChange}
                        className="form-control"
                        required
                    />
                </div>
                <div className="mb-3">
                    <label className="form-label">Upload creatives</label>
                    <CreativeInput
                        fileCount={fileCount}
                        handleChange={handleChange}
                    />
                    <button
                        type="button"
                        className="btn btn-sm btn-outline-dark float-right"
                        onClick={addMoreFileInput}
                    >
                        Add More File
                    </button>
                </div>

                <div className="d-grid mb-3">
                    <button type="submit" className="btn btn-success my-4">
                        Save
                    </button>
                </div>
            </form>
        </div>
    );
};

export default CampaignCreate;

if (document.getElementById("campaign-create")) {
    ReactDOM.render(
        <CampaignCreate />,
        document.getElementById("campaign-create")
    );
}
