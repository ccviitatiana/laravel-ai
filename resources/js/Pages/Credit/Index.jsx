import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head } from "@inertiajs/react";
import { useEffect } from "react";
import { toast } from "react-hot-toast";
import CreditPricingCards from "@/Components/CreditPricingCards";

export default function Index({ auth, packages, features, success, error }) {
    useEffect(() => {
        if (success) {
            setTimeout(() => {
                toast.success(`${success} ☆⌒(ゝ。∂)`, {
                    duration: 10000,
                    className: "font-medium",
                });
            }, 100);
        }
        if (error) {
            setTimeout(() => {
                toast.error(error);
            }, 100);
        }
    }, [success, error]);
    return (
        <AuthenticatedLayout
            user={auth.user}
            header={
                <h2 className="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    Your Credits
                </h2>
            }
        >
            <Head title="Your Credits" />
            <div className="py-8">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <CreditPricingCards
                        packages={packages.data}
                        features={features.data}
                    />
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
