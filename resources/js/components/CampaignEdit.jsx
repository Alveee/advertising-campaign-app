import React, { useEffect, useState } from "react";
import ReactDOM from "react-dom";
import axios from "axios";
import CreativeInput from "./CreativeInput";
import CampaignCreatives from "./CampaignCreatives";

const CampaignEdit = (props) => {
    const { campaignId } = props;
    const [campaign, setCampaign] = useState();
    const [fileCount, setFileCount] = useState(1);
    const [formData, setFormData] = useState();

    const getCampaign = () => {
        axios
            .get(`/api/v1/campaigns/${campaignId}`)
            .then((res) => {
                setCampaign(res.data.data);
                setFormData(res.data.data);
            })
            .catch((err) => {
                console.log(err);
            });
    };

    const handleChange = (event) => {
        let data = {};
        if (event.target.type === "file") {
            data[event.target.name] = event.target.files[0];
        } else if (event.target.type === "date") {
            data[event.target.name] = new Date(event.target.value)
                .toISOString()
                .slice(0, 10);
        } else {
            data[event.target.name] = event.target.value;
        }
        setFormData({ ...formData, ...data });
    };

    const updateCampaign = (event) => {
        event.preventDefault();

        const formdata = new FormData();
        for (let key in formData) {
            formdata.append(key, formData[key]);
        }
        formdata.append("_method", "PUT");

        axios
            .post(`/api/v1/campaigns/${campaign.id}`, formdata, {
                headers: {
                    "content-type": "multipart/form-data",
                },
            })
            .then((res) => {
                window.location = "/campaigns";
            })
            .catch((err) => {
                alert(err.response.data.message);
            });
    };

    const addMoreFileInput = () => {
        setFileCount(fileCount + 1);
    };

    useEffect(() => {
        getCampaign();
    }, []);

    return (
        <form onSubmit={updateCampaign}>
            <div className="mb-3">
                <label className="form-label">Name</label>
                <input
                    type="text"
                    name="name"
                    value={formData ? formData.name : ""}
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
                    value={
                        formData
                            ? new Date(formData.start_date)
                                  .toISOString()
                                  .slice(0, 10)
                            : ""
                    }
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
                    value={
                        formData
                            ? new Date(formData.end_date)
                                  .toISOString()
                                  .slice(0, 10)
                            : ""
                    }
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
                    value={formData ? formData.total_budget : ""}
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
                    value={formData ? formData.daily_budget : ""}
                    onChange={handleChange}
                    className="form-control"
                    required
                />
            </div>
            <div className="mb-3">
                <label className="form-label">Upload Creatives</label>
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
            {formData && (
                <CampaignCreatives creativeUploads={formData.creative_upload} />
            )}
            <div className="d-grid mb-3">
                <button type="submit" className="btn btn-success my-4">
                    Update
                </button>
            </div>
        </form>
    );
};

export default CampaignEdit;

if (document.getElementById("campaign-edit")) {
    let editDom = document.getElementById("campaign-edit");
    ReactDOM.render(
        <CampaignEdit campaignId={editDom.dataset.campaign_id} />,
        editDom
    );
}
